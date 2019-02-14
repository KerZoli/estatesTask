<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-body">
              <h4> Add Item </h4>
              <div class="row">
                <form>
                  <p v-if="errors.length">
                    <ul>
                      <li class="error" v-for="error in errors">{{ error }}</li>
                    </ul>
                  </p>
                  <input type="hidden" name="_token" :value="csrf">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <select v-model="country" class="form-control" id="country">
                        <option v-for="element in countriesList" v-bind:value="element.id">
                          {{element.country}}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="Developer">Developer</label>
                      <select v-model="developer" class="form-control" id="developer">
                        <option v-for="element in developersList" v-bind:value="element.id">
                          {{element.name}}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input v-model="name" type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input v-model="price" type="text" class="form-control" id="price" placeholder="Price">
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
                    <button v-on:click="onSubmit" class="btn btn-primary">submit</button>
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
  .error {
    color: red;
  }
</style>
<script>
    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                countriesList: [],
                developersList: [],
                country: '',
                developer: '',
                name: '',
                price: '',
                isOnSale: '',
                errors: []
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

          axios.get('/api/developers')
            .then(function (response) {
              self.developersList = response.data;
            })
            .catch(function (error) {
              console.log(error);
            })
        },
        methods: {
          onSubmit(event) {
            event.preventDefault();

            this.checkForm();

            if (this.errors.length > 0) {
              return;
            }

            let self = this;
            let obj = {
                //_token: this.csrf,
                city_id: this.country,
                developer_id: this.developer,
                name: this.name,
                price: this.price,
                isOnSale: this.isOnSale
            };

            axios.post('/api/list', obj)
              .then(function (response) {
                self.$root.$emit('eventAdded');
              })
              .catch(function (error) {
                console.log(error);
              });
          },

          checkForm() {
            this.errors = [];
            if (!this.country) {
              this.errors.push('Country is required.');
            }
            if (!this.developer) {
              this.errors.push('Developer is required.');
            }
            if (!this.name) {
              this.errors.push('Name is required.');
            }
            if (!this.price) {
              this.errors.push('Price is required.');
            }
            if (!/^\d+$/.test(this.price)) {
              this.errors.push('Price has to be a number');
            }
            if (!this.isOnSale) {
              this.errors.push('Is on Sale is required.');
            }
          }
        }
    }
</script>