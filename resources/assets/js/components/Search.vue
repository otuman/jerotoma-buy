<template>
   <div class="">
      <div class="input-field">
         <input id="search" v-model="search" v-on:keyup="searchData()" v-on:keyup.enter="searchData()" type="text" required>
      </div>
   </div>
</template>
<script>
    export default {
        data(){
          return {
            results:[],
            search:''
          }
        },
        mounted() {
            console.log('notification component.')
        },
       created(){

       },
       methods:{
         searchData:function(){
          // console.log(this.search);
           axios.post('/search', {
                   search: this.search
                 })
                 .then(function (response) {
                   console.log(response.data);
                 })
                 .catch(function (error) {
                   console.log(error);
                 });
         }
       }
    }
</script>
