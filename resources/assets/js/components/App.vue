<template>
  <div v-if="page == 'list'" class="container">
    <add-item />
    <filter-item />
    <list-item />
  </div>
  <div v-else>
    <detail-item :id="itemId"/>
  </div>
</template>

<script>
    import AddItem from './AddItem'
    import FilterItem from './FilterItem'
    import ListItem from './ListItem'
    import DetailItem from './DetailItem'

    export default {
      data() {
        return {
          page: 'list',
          itemId: ''
        }
      },
      mounted() {
        let self = this;
        this.$root.$on('changePage', data => {
          this.page = data.name;
          if ('id' in data) {
            this.itemId = data.id
          }
        });
      }
    }
</script>