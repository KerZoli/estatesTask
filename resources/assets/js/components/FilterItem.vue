<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-body">
            	<h4> Filter Component </h4>
               <div class="row">
                <form>
                  <input type="hidden" name="_token" :value="csrf">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <select v-model="country" class="form-control" id="filter_country">
                        <option v-for="element in countriesList" v-bind:value="element.id">
                          {{element.country}}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="filter_price">Price</label>
                      <input v-model="price" type="text" class="form-control" id="filter_price" placeholder="Price less then">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="isOnSale">Is On Sale</label>
                      <select v-model="isOnSale" class="form-control" id="isOnSale">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                  <div class="form-group">
                    <button v-on:click="filterResults" class="btn btn-primary">submit</button>
                  </div>
                  </div>
               	</form>
           	</div>
          </div>
        </div>
    </div>
  </div>
 </div>
</template>

<script>
    export default {
      data() {
        return {
        	csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          countriesList: [],
          country: '',
          isOnSale: '',
          price: '',
        }
      },
      created() {
        var self = this;
        axios.get('/api/countries')
          .then(function (response) {
            self.countriesList = response.data;
          })
          .catch(function (error) {
            console.log(error);
        })
      },
			mounted() {
			   this.$root.$on('eventing', data => {
			      console.log(data);
			   });
			},
      methods: {
        filterResults(event) {
          event.preventDefault();	
          let self = this;
          let data = {};
          let filters = ['country', 'price', 'isOnSale'];
          
          for (let i=0; i < filters.length; i++) {
          	if (this[filters[i]] !== '') {
          		data[filters[i]] = this[filters[i]];
          	}
          }
	        axios.get('/api/list', {
	        	params: data
	        })
	        .then(function (response) {
						self.$root.$emit('filter', response.data);
	        })
	        .catch(function (error) {
	          console.log(error);
	        })

        }
      }
    }
</script>