<template>
  <li class="nav-item dropdown">
    <a class="nav-link" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-bell"></i>
         <span class="badge badge-pill badge-danger position-relative" style="bottom:10px;right:15px;">{{notifications.count}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="notificationDropdown">
           <template v-for="item in notifications.items">
             <a class="dropdown-item" href="#">
                <div>
                  <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                  <span class="mr-auto p-2 text-muted small">4 minutes ago</span>
                </div>
              </a>
              <div class="dropdown-divider"></div>
           </template>
           <div class="text-center link-block">
              <a href="notifications.html">
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
              </a>
          </div>
    </div>
  </li>
</template>
<script>
    export default {
        data(){
          return {
            notifications:{
              count: 23,
              items:[
                {},
                {},
                {},
                {},
                {},
                {}
              ],
            }
          }
        },
        mounted() {
            console.log('Component mounted.')
            Echo.private(`order.${orderId}`)
                .listen('NewOrderCreated', (e) => {
                    console.log("Order created");
                });
        }
    }
</script>
