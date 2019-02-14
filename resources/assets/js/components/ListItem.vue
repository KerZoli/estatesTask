<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-body">
            	<h4> Estate List </h4>
                <div class="row">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Title</th>
                      <th scope="col">Country</th>
                      <th scope="col">Price</th>
                      <th scope="col">OnSale</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="estate in estateList">
                      <td>{{estate.id}}</td>
                      <td><a class="details-link" v-on:click="showDetails(estate.id)">{{estate.name}}</a></td>
                      <td>{{estate.country}}</td>
                      <td>{{estate.price}}</td>
                      <td v-if="estate.isOnSale">
                        Yes
                      </td>
                      <td v-else>
                        No
                      </td>
                    </tr>
                  </tbody>
                </table>
               </div>
           	</div>
          </div>
        </div>
    </div>
  </div>
 </div>
</template>

<style>
  .details-link {
    color: #636b6f;
    text-decoration: none;
  }

  .details-link:hover {
    color: #636b6f;
    text-decoration: none;
  }
</style>
<script>
    export default {
      data() {
        return {
          estateList: []
        }
      },
      created() {
        var self = this;
        axios.get('/api/list')
        .then(function (response) {
          self.estateList = response.data;
        })
        .catch(function (error) {
          console.log(error);
        })
      },
			mounted() {
        let self = this;
			  this.$root.$on('filter', data => {
			    self.estateList = data;
			  });

        this.$root.$on('eventAdded', data => {
          axios.get('/api/list')
          .then(function (response) {
            console.log(response);
            self.estateList = response.data;
          })
          .catch(function (error) {
            console.log(error);
          })
        });
			},
      methods: {
        showDetails(id) {
          this.$root.$emit('changePage', {
              name: 'details',
              id: id
            }
          );
        }
      }
    }
</script>