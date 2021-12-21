<template>
    <button :class="classes" @click="click(data)" title="Update">
        
            <i class="fa fa-edit" aria-hidden="true"></i>
       
        &nbsp;
       
    </button>
    
    
</template>
<script>
export default {
    props: {
        data: {},
        name: {},
        click: {},
        classes: {},
    }
}
</script>