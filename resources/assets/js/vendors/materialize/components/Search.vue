<template>
  <div class="row search-row">
    <div class="col m12">
        <div class="row search-row">
          <div class="col m8 offset-m2">
            <nav class="nav-search-wrapper">
                <div class="nav-wrapper">
                  <form>
                    <div class="input-field" >
                      <input id="search" @focus='focused()' @blur='notFocused()' v-model="search.searchKeyWord" v-on:keyup="searchData()" v-on:keyup.enter="searchData()" type="search" placeholder="Search products" required>
                       <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                      <i class="material-icons">close</i>
                    </div>
                  </form>
                </div>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col m8 offset-m2">
            <div v-bind:class="{ 'search-result-wrapper' : search.hasOutput, 'search-not-active':!search.hasOutput}" >
               <span class="header">Search result for '{{search.searchKeyWord}}'</span>
                 <ul v-if='search.receivedData' class="collection">
                    <a  v-for='item in search.response' v-bind:href="processSlugUrl(item.slug)" class="collection-item avatar">
                      <img v-bind:src="processImgUrl(item.image)" alt="" class="circle">
                      <span class="title">{{item.name}}</span>
                      <p>Price ${{item.price}}</p>
                    </a>
                 </ul>
                 <ul  v-else class="collection">
                    <a class="collection-item">
                        <p>Sorry, we couldn't find a item(s) with keyword '{{search.searchKeyWord}}'</p>
                    </a>
                 </ul>

            </div>
          </div>
        </div>
     </div>
  </div>
</template>
<script>
import { focus } from 'vue-focus';

export default {
        directives: { focus: focus },
        data(){
          return {
            search:{
              response:[],
              searchKeyWord:'',
              hasOutput:false,
              focused:false,
              receivedData:false
            }

          }
        },
        mounted() {
            console.log('Search component.')
        },
        created(){

        },
        methods:{
          searchData:function(){
              if(this.search.searchKeyWord.length > 0 ){
                 axios.post('/search', {
                         search: this.search.searchKeyWord
                       })
                       .then((response)=>{

                        if(response.data.length > 0 ){
                            this.search.response = response.data;
                            this.search.hasOutput= true;
                            console.log(this.search.response);
                            this.search.receivedData = true;
                         }else{
                            this.search.receivedData = false;
                         }
                       })
                       .catch(function (error) {
                         console.log(error);
                       });
               }else{
                 this.search.hasOutput= false;
               }
         },
         processImgUrl:function(urlPart){
           var host = window.location.origin;
           return host+'/storage/products/'+urlPart;
         },
         processSlugUrl:function(urlPart){
           var host = window.location.origin;
           return host+'/shop/'+urlPart;
         },
         focused:function(){
           console.log("Focused");
           this.search.focused=true;
           this.searchData();
         },
         notFocused:function(){
            this.search.focused=false;
            this.searchData();
            console.log("Not Focused");
          }
       }

    }
</script>
<style scoped>
   .header {
        color: #ee6e73;
        font-weight: 700;
        margin-left: 15px;
        font-size:18px;
    }
   nav .input-field label {
      top: -18px;
      left: 6px;
   }
   nav .input-field label i{
     color:#9e9e9e
   }
   .nav-wrapper .input-field input[type=search] {
    height: 50px;
    padding-left: 4rem;
    width: calc(100% - 4rem);
    border: 0;
    color:rgba(0, 0, 0, 0.5);
    -webkit-box-shadow: none;
    box-shadow: none;
   }
   .input-field input[type=search] ~ .material-icons {
    position: absolute;
    top: -6px;
    right: 1rem;
    cursor: pointer;
    font-size: 2rem;
    -webkit-transition: .3s color;
    transition: .3s color;
   }
   .nav-search-wrapper{
    margin-top: 8px;
    background-color: transparent;
    webkit-box-shadow:none;
    box-shadow:none;
   }
   .search-result-wrapper{
       background-color:#EAF1F1;
       margin-top: -14px;
       position: absolute;
       width: 46.22%;
       right: 26.89%;
       z-index: 9999;

   }
   .search-not-active{
     display: none;
   }
   .row.search-row{
     margin-bottom: 0;
   }

</style>
