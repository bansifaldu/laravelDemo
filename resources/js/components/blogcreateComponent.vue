 <template>
  
    <div>
    <div class="card-header">
        <h3 class="card-title">Blog Create</h3>
    </div>
    <form @submit.prevent="submit">
    <div class="card-body">
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" value="this.e_id" name="title" id="title" class="form-control"   placeholder="Title" v-model="fields.title" >
                <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <input type="text" value="" name="category" id="category" class="form-control"   placeholder="Category" v-model="fields.category">
                <div v-if="errors && errors.category" class="text-danger">{{ errors.category[0] }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" value="" name="description" id="description" class="form-control"   placeholder="Description" v-model="fields.description">
                <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
            </div>
        </div>
  	</div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <div v-if="success" class="alert alert-success mt-3">
            Blog created successfully!
        </div>
          <a v-bind:href="'/blogs/blogs_management'">  <button   type="button" class="btn btn-default float-right">Cancel</button> </a>
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
 		        axios.post('/blogs/create_blogs_save', this.fields).then(response => {
	          	this.fields = {}; //Clear input fields.
		          	 window.location = '/blogs/blogs_management'
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