<template>
    <div>
        <ul>
            <li v-for="user in users" :key="user.id">
                {{ user.name }} ({{ user.email }})
            </li>
        </ul>
    </div>
    <div>
        malcon
    </div>
</template>

<script>
export default {
    props: {
        users: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>
ul {
    list-style-type: none;
    padding: 0;
}
li {
    padding: 5px 0;
    border-bottom: 1px solid #ccc;
}
</style>