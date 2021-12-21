<template>
 <div>
<div v-if="success" class="alert alert-success mt-3">
            Deleted successfully!
        </div>
    <data-table
        :data="data"
        :columns="columns"
        @on-table-props-changed="reloadTable">
         <thead slot="header" slot-scope="{ tableProps }">
             
            <tr>
                <th  @click="sort('id', tableProps)">ID</th>
                <th @click="sort('name', tableProps)">Title</th>
                <th colspan="2">Action</th>
             </tr>
        </thead>
    </data-table>
   </div>
</template>

<script>
import Editcategory from './Editcategory.vue';
import Deletecategory from './Deletecategory.vue';
export default {
    data() {
        return {
        sortOrders: {},
            url: "/category/list",
            data: {},
            tableProps: {
                search: '',
                length: 10,
                column: 'id',
                dir: 'asc'
            },
            columns: [
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Name',
                    name: 'name',
                    orderable: true,
                },
                {
                        label: 'Action',
                        name: 'action',
                        filterable: false,
                             component: Editcategory,
                            event: "click",
                            handler: this.editcategory,
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
                        component: Deletecategory, 
                        event: "click",
                        handler: this.deletecategory,
                        classes: { 
                            'btn': true,
                            'btn-danger': true,
                            'btn-sm': true,
                        } 
                        
                    },
            ]
        }
    },
    components: {
        // eslint-disable-next-line
        Editcategory,Deletecategory
    },
    created() {
        this.getData(this.url);
    },
    mounted() {
        this.columns.forEach((column) => {
            this.sortOrders[column.name] = -1;
        });
    },
    methods: {
        getData(url = this.url, options = this.tableProps) {
            axios.get(url, {
                params: options
            })
            .then(response => {
                this.data = response.data;
            })
            // eslint-disable-next-line
            .catch(errors => {
                //Handle Errors
            })
        }, editcategory(data) {
            window.location = '/category/category_edit/' + data.id
        
            
        },
        deletecategory(data) {
        this.success = false;
        this.errors = {};
                axios.post('/category/deleteData', {id: data.id}).then(response => {
        
                this.success = true;
                this.reloadTable(this.tableProps)

                }).catch(error => {
                    if (error.response.status === 422) {
                      this.errors = error.response.data.errors || {};
                    } 
                });
        },
        reloadTable(tableProps) {
            this.getData(this.url, tableProps);
        },

         sort(key, tableProps) {
            tableProps.column = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            tableProps.dir =  this.sortOrders[key] === 1 ? 'desc' : 'asc';
        }
    }
}
</script>