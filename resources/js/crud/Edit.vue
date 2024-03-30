<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto">
        <div class="card">
          <div class="card-header">
            <router-link :to="{ name: 'List' }" class="btn btn-primary">
              List</router-link
            >
          </div>
          <div class="card-body">

            <form @submit.prevent="UpdateData">
              <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" v-model="formData.product_name">
                <span class="text-danger" v-for="(error, index) in  formError.product_name " :key="index">{{error}}</span>
              </div>
              <div class="mb-3">
                <label class="form-label">Product Price</label>
                <input type="text" class="form-control" v-model="formData.product_price">
                <span class="text-danger" v-for="(error, index) in  formError.product_price " :key="index">{{error}}</span>
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
data(){
    return{
        formData:{
            product_name: '',
            product_price: ''
        },
        formError:{
            product_name:'',
            product_price: ''
        }
    }
},
mounted(){
this.edit();
},
methods:{
edit(){
    axios.get('/api/product/show/'+this.$route.params.id)
    .then((success)=>{
        this.formData = success.data.product
    }).catch((error)=>{
        console.log(error);
    });
},
UpdateData(){
    axios.post('/api/product/update/'+this.$route.params.id,this.formData)
    .then((success)=>{

        this.$router.push({name: 'List'});
    }).catch((error)=>{
        console.log(error);
    });
}

}

};
</script>

<style>
</style>
