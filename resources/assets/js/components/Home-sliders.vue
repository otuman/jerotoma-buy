
  <template>
     <div class="carousel carousel-slider">
        <a class="carousel-item" href="#one!"><img src="https://lorempixel.com/800/400/food/1"></a>
        <a class="carousel-item" href="#two!"><img src="https://lorempixel.com/800/400/food/2"></a>
        <a class="carousel-item" href="#three!"><img src="https://lorempixel.com/800/400/food/3"></a>
        <a class="carousel-item" href="#four!"><img src="https://lorempixel.com/800/400/food/4"></a>
      </div>
  </template>
  <script>
      export default {
          mounted() {
              $('.carousel.carousel-slider').carousel({
                fullWidth: true,
                indicators:true,
                duration:100
              });
              this.autoplay();
          },
          methods:{
            autoplay:function(){
              setInterval(function() {
                  $('.carousel').carousel('next');
              }, 3000); // every 2 seconds
            }
          },
          created(){

            console.log('propertyComputed will update, as this.property is now reactive.')
          }
      }
  </script>
