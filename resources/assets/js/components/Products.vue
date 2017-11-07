<template>
    <div class="container">
        <div class="row" v-for="chunk in products">
            <div class="col m3" v-for="product in chunk">
             <div class="card">
                 <div class="card-image waves-effect waves-block waves-light">
                     <a v-bind:href="processedUrl(product.slug)"><img v-bind:src="imgProcessedUrl(product.image)" alt="product" class="responsive-img activator"></a>
                 </div> <!-- end caption -->
                 <div class="card-content">
                   <span class="activator grey-text text-darken-4">{{product.name }}<i class="material-icons right">more_vert</i></span>
                   <p><a href="">This is a link</a></p>
                 </div>
                 <div class="card-reveal">
                   <span class="card-title grey-text text-darken-4">{{product.name}}<i class="material-icons right">close</i></span>
                   <p>{{ product.name }}</p>
                 </div>
                 <div class="card-action">
                   <a class="btn-floating btn waves-effect waves-light red"><i class="large material-icons">add_shopping_cart</i></a>
                   <a class="btn-floating btn waves-effect waves-light red right"><i class="large material-icons">favorite</i></a>
                 </div>
             </div> <!-- end thumbnail -->
            </div>
        </div>
    </div>
</template>
<script>
    export default {
         data(){
          return {
            products:[]
          }
         },
         mounted() {
            //console.log('notification component.')
         },
         methods:{
           imgProcessedUrl: function(urlPart){
             var host = window.location.origin;
             return host+'/storage/products/'+urlPart;
           },
           processedUrl:function(urlPart){
             var host = window.location.origin;
             return host+'/shop/'+urlPart;
           }
         },
         created(){
            axios.get('/products').then(response=>{

                this.products = response.data;
                 console.log(this.products);
                 //console.log(response);
            });
         }
    }
</script>
