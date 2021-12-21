 
jQuery(document).ready(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery("#registration_form").validate({
          // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name : {
        required: true,
        },
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true,
        remote: {
          url: "/varifyemail",
          type: "GET",
        },
      },
      password: {
        required: true,
        minlength: 5
      },
      password_confirmation : {
        required: true,
        equalTo : "#password"
    }
    },
    // Specify validation error messages
    messages: {
      name: {
        required: "Please provide a name",
       },
      email: {
        required: "Please provide a email",
        email: "Please enter a valid email address",
        remote : "Please enter unique email address",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      password_confirmation: {
        required: "Please provide a confirmation password",
        equalTo: "Your confirm password must be same as password"
      },
     },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 
