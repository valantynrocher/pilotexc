<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="exercise in exercises" :key="exercise.id">
                <a href="#">{{ exercise.name }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data () {
            return {
            exercises: {}
            }
        },
        created () {
            axios.get('/axios')
            .then(response => (this.exercises = response.data))
            .catch(error => console.log(error));
        }
    }
</script>
