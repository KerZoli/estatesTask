<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
          	<a v-on:click="showList">Back</a>
          	<h4> Item </h4>
          	<div class="row">
          		<div class="col-md-6">
          			<b> Name: </b> {{item.name}}
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-md-6">
          			<b> City: </b> {{item.city}}
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-md-6">
          			<b> Country: </b> {{item.country}}
          		</div>
          	</div>    
          	<div class="row">
          		<div class="col-md-6">
          			<b> Price: </b> {{item.price}}
          		</div>
          	</div>        	
          	<div class="row">
          		<div class="col-md-6">
          			<b> On Sale: </b> {{item.isOnSale}}
          		</div>
          	</div>   
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
    	props: ['id'],
    	data() {
    		return {
    			item: {}
    		}
    	},
      methods: {
        showList() {
          this.$root.$emit('changePage', {
          	name: 'list'
          });         
        }
      },
      created() {
      	let self = this;
        axios.get('/api/list/' + this.id)
        	.then(function (response) {
        		console.log(response);
        		self.item = response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      }
   	}
</script>