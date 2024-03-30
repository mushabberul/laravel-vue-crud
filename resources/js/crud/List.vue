<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <router-link :to="{ name: 'AddNew' }" class="btn btn-primary">
              Add New</router-link
            >
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product ,index) in products" :key="product.id">

                  <th scope="row">{{ ++index }}</th>
                  <td>{{ product.product_name }}</td>
                  <td>{{ product.product_price }}</td>
                  <td>
                    <router-link :to="{name: 'Edit',params:{id: product.id}}" class="btn btn-primary">Edit</router-link>

                    <a @click.prevent="destroy(product.id)" class="btn btn-danger">Delete</a>

                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            products: [],
        }
    },
    mounted(){
       this.ProductList();
    },
    methods:{
        ProductList(){
            axios.get('/api/product')
        .then((success)=>{
            this.products = success.data.products;
        }).catch((errors)=>{
            console.log(errors);
        });
        },
        destroy(product_id){
            axios.delete('/api/product/delete/'+product_id)
            .then((success)=>{
                console.log(success);
                this.ProductList();
            }).catch((error)=>{
                console.log(error);
            });
        }

    }
};
</script>

<style>
</style>
