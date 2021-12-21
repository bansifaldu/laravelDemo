 <template>
  
    <div>
    <div class="card-header">
        <h3 class="card-title">Category Edit</h3>
    </div>
    <form @submit.prevent="submit">
    <div class="card-body">
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Nmae</label>
            <div class="col-sm-10">
                <input type="text" value="name" name="name" id="name" class="form-control"   placeholder="Name" v-model="name" >
                <div v-if="errors && errors.title" class="text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>
         
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <div v-if="success" class="alert alert-success mt-3">
            Category Edited successfully!
        </div>
          <a v-bind:href="'/category/category_management'">  <button   type="button" class="btn btn-default float-right">Cancel</button> </a>
    </div>       
        
    </form>
   </div>
  
</template>

<script>
import FormMixin from '../FormMixin';

export default {
props: ['category'],
 mixins: [ FormMixin ],
    data() {
        return {
          fields: {},
          errors: {},
          success: false,
          loaded: true,

          name: this.category.name,
          
        }
    },

    methods: {
        submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                 var name = document.getElementById('name');
                 
                  

                 
                axios.post('/category/category_edit_save', {name: name.value,id: this.category.id}).then(response => {
                 
                   window.location = '/category/category_management'
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },
    },
}
</script>