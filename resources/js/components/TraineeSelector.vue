<template>
    <div class="form-group">
        <label for="user">Please select trainees:</label>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle col-12 m-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Trainees select box
            </button>
            <div class="dropdown-menu col-12" aria-labelledby="dropdownMenuButton">
                <input type="text" class="form-control col-11 m-auto" name="" placeholder="" v-model="keyword" v-on:input="debounceInput">
                <a class="dropdown-item" 
                    v-for="trainee in trainees" 
                    :key="trainee.id" href="#"
                    @click.prevent="selectedTrainees.includes(trainee) ? '' : selectedTrainees.push(trainee) "
                    >{{trainee.name}} - {{trainee.email}}
                   
                </a>
            </div>
            <div class="traineeItem row justify-content-between bg-olive" 
                v-for="(selectedTrainee, index) in selectedTrainees" 
                :key="selectedTrainee.id"
            >
            {{selectedTrainee.name}} - {{selectedTrainee.email}} 
            <span class="ml-auto active" @click.prevent="selectedTrainees.splice(index,1)">x</span>
            </div>
            <input type="hidden" name="users[]" 
            v-for="(selectedTrainee, index) in selectedTrainees" 
            :key="'I'+selectedTrainee.id"
            :value="selectedTrainee.id"
            />
        </div>
        
            
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        mounted() {
            this.getTrainees();
        },
        data() {
            return {
                keyword : '',
                trainees: [],
                selectedTrainees: []
            }
        },

        methods: {
            getTrainees() {
                axios.get("./trainees?keyword="+this.keyword).then((response) => {
                    this.trainees = response.data;
                });
            },
            debounceInput: _.debounce( function() {
                    this.getTrainees();
            }, 1000)
        },
    }
</script>
<style scoped>
.traineeItem {
    border: 1px solid #316f54;
    border-radius: 5px;
    padding: 4px 8px;
    margin: 10px 0px;
}
.active:hover {
    cursor: pointer;
}
</style>