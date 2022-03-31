<template>
    <div id="test" class="form-group">

            <div class="form-group text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new question</button>

            <div class="modal fade bd-example-modal-lg text-left" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="form-group">
                                <label class="col-form-label">Question:</label>
                                <input type="text" name="title" v-model="title" class="form-control" placeholder="Enter question">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Answer:</label>
                                <input type="text" name="answer" v-model="answer" class="form-control" placeholder="Enter Answer">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" 
                                @click.prevent=" answer != '' ? addAnswer(answer): ''"
                                >Add answer</button>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Answers:</label>
                                <p 
                                v-for="(answer, index) in answers" 
                                :key="index"
                                >{{ index+1 }}. {{answer}}
                                <span class="ml-auto text-red" @click.prevent="answers.splice(index,1)">x</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">True Answer:</label>
                                <select v-model="trueAnswer">
                                    <option
                                    v-for="(answer, index) in answers" 
                                    :key="index"
                                    :value="answer">{{ index+1 }}. {{answer}}</option>
                                </select>
                            </div>
                            
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" @click.prevent="addQuestion()">Add question</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="form-group">
                <label>Questions:</label>
                <div class="form-group" 
                    v-for="(question, index) in questions" 
                    :key="index"
                >
                    <label for="name">Question {{ index+1 }}: {{JSON.parse(question).title}}</label>
                    <span class="ml-auto text-red" @click.prevent="questions.splice(index,1)">Delete</span>
                    <div class="ml-4"
                        v-for="(answerr, index) in JSON.parse(question).answers" 
                        :key="index"
                    >
                        {{ index+1 }}. {{ answerr }}
                    </div>
                    <div class="ml-4">Answer: {{JSON.parse(question).trueAnswer}}</div>
                    
                </div>
                <input type="hidden"
                    v-for="(question, index) in questions" 
                    :key="'I'.index"
                    :value="question"
                    name="questions[]"
                >
            </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['username'],
        mounted() {
            this.getQuestion();
        },
        data() {
            return {
                answer: '',
                answers: [],
                trueAnswer: '',
                title: '',
                question: [],
                questions: [],
            }
        },

        methods: {
            getQuestion() {
                axios.get("./").then((response) => {
                    // console.log(response.data.questions);
                    response.data.questions.forEach(e => {
                        this.questions.push(e.content);
                    });
                });
            },
            addAnswer(answer) {
                this.answers.push(answer);
                this.answer = '';            
            },
            addQuestion() {
                if(this.title != '' && this.answers.length > 0 && this.trueAnswer != '') {
                    this.question = JSON.stringify({
                        'title' : this.title,
                        'answers': this.answers,
                        'trueAnswer': this.trueAnswer,
                    });
                    this.questions.push(this.question);
                    // console.log(JSON.stringify(this.questions));
                    // console.log(typeof this.question.answers);
                    this.title = '';
                    this.answers = [];
                    this.answer = '';
                    this.trueAnswer = [];
                    this.question = [];
                }
            },
        },
    }
</script>
<style scoped>

</style>