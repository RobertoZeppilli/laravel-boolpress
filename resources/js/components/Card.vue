<template>
  <div class="col-4 my-3 d-flex">
    <div class="card w-100">
      <div class="card-body">
        <h4 class="card-title">{{ post.title }}</h4>
        <p>{{ post.extract }}</p>
        <!-- <a href="#" class="card-link">Leggi</a> -->
        <div v-show="(post.category_id)">
            <span>Category: </span>
            <span class="badge badge-dark" v-for="(category, index) in categories" :key="index">{{ post.category_id == category.id ? category.name : '' }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    post: Object,
    categories: Array,
    // tags: Array
  },
};
</script>

<style>
</style>