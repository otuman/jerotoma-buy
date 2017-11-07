<template>
   <div v-bind:class="{'search-wrapper':!search.hasOutput,'card-panel search-panel':search.hasOutput}">
      <div class="input-field">
        <i class="material-icons right prefix">search</i>
        <input id="search" v-model="search.searchKeyWord" v-on:keyup="searchData()" v-on:keyup.enter="searchData()" type="text" placeholder="Search products" required>
      </div>
      <div v-if="search.hasOutput" class="collection search-output">
        <a v-for="item in search.response" v-bind:href="processSlugUrl(item.slug)" class="collection-item avatar">
            <img v-bind:src="processImgUrl(item.image)" alt="" class="circle">
            <span class="title">{{item.name}}</span>
            <p>First Line <br>
              Second Line
            </p>
        </a>
        <a href="#!" class="collection-item avatar list-aligoria"><span class="secondary-content"><img src="/storage/logos/search-by-algolia.png" class="aligolia" alt=""></span></a>
      </div>
   </div>
</template>
<script>
    export default {
        data(){
          return {
            search:{
              response:[],
              searchKeyWord:'',
              hasOutput:false
            }

          }
        },
        mounted() {
            console.log('notification component.')
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
                         }else{
                           this.search.hasOutput= false;
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
         }
       }

    }
</script>
<style>
  #search{
    margin-right: 20px;
    padding-left:8px;
    width:90%;
    height: 25px;
  }
  #search:focus{
    border-bottom: 1px solid #ee6e73;
    box-shadow: 0 1px 0 0 #ee6e73;
    webkit box-shadow:0 1px 0 0 #ee6e73;
  }
  #search, .search-wrapper, .card{
    color: rgba(0, 0, 0, 0.7);
    font-size:20px;
  }
  .search-wrapper{
    padding-left: 15px;
    padding-right: 15px;
    border-radius:10px;
    background-color: #FFF;
    width: auto;
    height: 56px;
    margin-top: 5px;
  }
  .search-panel{
    position: absolute;
    right:auto;
    padding: 10px;
    margin: 0.5rem 0 1rem 0;
    border-radius: 2px;
    background-color: #fff;
    width: 50rem;
    z-index: 200;
  }
  .aligolia{
    width:auto;
    height:15px;
  }
  .list-aligoria{
     width:auto;
     height:20px;
  }
.collection .collection-item.list-aligoria {
    min-height: 50px;
    padding-left: 72px;
    position: relative;
}
</style>
