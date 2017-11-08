<template>
    <div class="container">
        <div class="row" v-for="chunk in products">
            <div class="col m3" v-for="product in chunk">
             <div class="card">
                 <div class="card-image waves-effect waves-block waves-light">
                     <a v-bind:href="processSlugURL(product.slug)"><img v-bind:src="processImageURL(product.image)" alt="product" class="responsive-img activator"></a>
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
                   <a class="btn-floating btn waves-effect waves-light red" @click="addProductToCart(product)"><i class="large material-icons">add_shopping_cart</i></a>
                   <a class="btn-floating btn waves-effect waves-light red right" @click="addProductToWishlist(product)"><i class="large material-icons">favorite</i></a>
                 </div>
             </div> <!-- end thumbnail -->
            </div>
        </div>
    </div>
</template>
<script>
    var home_url = window.location.origin;
    console.log(home_url);
    export default {
         data(){
          return {
            products:[],
            _host: home_url
          }
         },
         mounted() {
            //console.log('notification component.')
         },
         methods:{
           processImageURL:(urlPart)=>{
             return home_url+'/storage/products/'+urlPart;
           },
           processSlugURL:(urlPart)=>{

              return home_url+'/shop/'+urlPart;
           },
           addProductToWishlist:(product)=>{
             console.log(product.id);
           },
           addProductToCart:(product)=>{
             console.log(product.price);
             console.log(product.image);
             console.log(product.name);
             console.log(product.id);
             axios.post('/cart',{
               'id':product.id,
               'quantity': 1,
               'name':product.name,
               'price':product.price
             }).then((response)=>{
              // console.log(response.data);
               if(response.data.success){
                 location.assign(home_url+'/cart');
               }
             });
          }
         },
         created(){
            axios.get('/products').then((response)=>{

                this.products = response.data;
                // console.log(this.products);
                 //console.log(response);
            });
         }
    }
</script>
