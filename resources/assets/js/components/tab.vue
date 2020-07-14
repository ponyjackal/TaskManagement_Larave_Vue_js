<template>
    <div v-show="isActive"><slot></slot></div>
</template>

<script>
    export default{
        
        name : 'myTab',

        props: {
            name: { required: true },
            selected: { default: false}
        },
        
        data() {
            
            return {
                isActive: this.selected=='true'?true:false
            };
            
        },
        
        computed: {
            
            href() {
                return '#' + this.name.toLowerCase().replace(/ /g, '-');
            }
        }
    }
</script>
