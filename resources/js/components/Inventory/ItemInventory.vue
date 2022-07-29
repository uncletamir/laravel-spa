<template>
    <div class="form-group" v-for="(list,k) in lists" :key="k">
        <input type="text" class="form-control" v-model="list.name">
        <span>
            <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && lists.length > 1)"></i>
            <i class="fas fa-plus-circle" @click="add(k)" v-show="k == lists.length-1"></i>
        </span>
    </div>
</template>

<script>
export default {
     data: {
        lists: [
            {
                name: ''
            }
        ]
    },
    methods: {
        add(index) {
            this.lists.push({ name: '' });
        },
        remove(index) {
            this.lists.splice(index, 1);
        }
    }
}
</script>