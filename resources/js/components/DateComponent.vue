<template>
    <div class="datetime"> 
        <m-date-picker v-model="date" :lang="lang" :multi="multi" :always-display="false" :format="formatDate"></m-date-picker>
    </div>
</template>
<script>
import mDatePicker from './multiDatePicker';
export default {
    data () { 
        return {  
            multi: true,
            lang: "en",
            date: []
        }
    },
    components: {'m-date-picker': mDatePicker },
    methods: {
        formatDate(date) {
            return data.toLocaleDateString();   
        }
    }
}
</script>