 <template>
  
    <div>
    <div class="card-header">
        <h3 class="card-title">Category Create</h3>
    </div>
    <form @submit.prevent="submit">
    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" value="" name="name" id="name" class="form-control"   placeholder="Name" v-model="fields.name" >
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>
         
  	</div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <div v-if="success" class="alert alert-success mt-3">
            Category created successfully!
        </div>
          <a v-bind:href="'/category/category_management'">  <button   type="button" class="btn btn-default float-right">Cancel</button> </a>
    </div>  	 
        
    </form>
   </div>
  
</template>

<script>
import FormMixin from '../FormMixin';

export default {
mixins: [ FormMixin ],
  	data() {
    	return {
	      fields: {},
	      errors: {},
	      success: false,
	      loaded: true,
    	}
  	},
  	methods: {
    	submit() {
      		if (this.loaded) {
		        this.loaded = false;
		        this.success = false;
		        this.errors = {};
 		        axios.post('/category/create_category_save', this.fields).then(response => {
	          	this.fields = {}; //Clear input fields.
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