<template>
    <div>
        <div v-if="success" class="alert alert-success mt-3">
            Deleted successfully!
        </div>
   
  <data-table
    :columns="columns" 
    url="/blogs/list">
    <thead slot="header" slot-scope="{ tableProps }">
             
            <tr>
                <th  @click="sort('id', tableProps)">ID</th>
                <th @click="sort('title', tableProps)">Title</th>
                <th @click="sort('category', tableProps)">Category</th>
                <th @click="sort('description', tableProps)">Description</th>
                <th colspan="2">Action</th>
             </tr>
        </thead>
</data-table> </div>
</template>

<script>

    import ExampleButton from './ExampleButton.vue';
    import DeleteButton from './DeleteButton.vue';
   export default {

         
     data() {

       
        return {
         success: false,
            columns: [{
                        label: 'ID',
                        name: 'id',
                        filterable: true,
                        orderable: true,
                    },
                    {
                        label: 'title',
                        name: 'title',
                        filterable: true,
                        orderable: true,
                    },
                    {
                        label: 'category',
                        name: 'category',
                        filterable: true,
                        orderable: true,
                    },
                    {
                        label: 'description',
                        name: 'description',
                        filterable: true,
                        orderable: true,
                    },

                    {
                        label: 'Action',
                        name: 'action',
                        filterable: false,
                             component: ExampleButton,
                            event: "click",
                            handler: this.editblog,
                            classes: { 
                                'btn': true,
                                'btn-primary': true,
                                'btn-sm': true,
                            } 
                        
                    },
                    {
                        label: 'Delete',
                        name: 'delete',
                        filterable: false,
                        component: DeleteButton, 
                        event: "click",
                        handler: this.deleteblog,
                        classes: { 
                            'btn': true,
                            'btn-danger': true,
                            'btn-sm': true,
                        } 
                        
                    },
                     
                ],
        }
    },
     components: {
        // eslint-disable-next-line
        ExampleButton,DeleteButton
    },
    methods: {
        editblog(data) {
            window.location = '/blogs/blogs_edit/' + data.id
        
            
        },
         deleteblog(data) {
          this.success = false;
        this.errors = {};
                axios.post('/blogs/deleteData', {id: data.id}).then(response => {

        //$('#example').DataTable().ajax.reload();
                this.success = true;

                }).catch(error => {
                    if (error.response.status === 422) {
                      this.errors = error.response.data.errors || {};
                    } 
                });
        },
         sort(key, tableProps) {
            tableProps.column = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            tableProps.dir =  this.sortOrders[key] === 1 ? 'desc' : 'asc';
        }
    },
}

</script>