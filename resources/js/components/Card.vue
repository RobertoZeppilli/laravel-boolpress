<template>
  <div class="col-4 my-3 d-flex">
    <div class="card w-100 rounded">
      <div class="card-body">
        <h3 class="card-title">{{ post.title }}</h3>

        <div class="overflow-hidden">
          <vue-load-image>
            <img class="post-img w-100 mb-2" slot="image" :src="post.cover" />
            <img class="w-100" slot="preloader" src="https://i.stack.imgur.com/ndqUb.gif" />
            <div class="text-danger" slot="error">No cover found.</div>
          </vue-load-image>
        </div>
        <p>{{ post.extract }}</p>
        <div v-if="post.category_id">
          <span class="font-weight-bold">Category: </span>
          <router-link
            :to="{ name: 'category', params: { slug: category.slug } }"
            class="badge badge-info text-light"
            v-for="(category, index) in categories"
            :key="index"
            >{{
              post.category_id == category.id ? category.name : ""
            }}</router-link
          >
        </div>
        <div v-else>
          <span class="font-weight-bold"
            >Category: <strong class="no text-danger">none</strong></span
          >
        </div>
        <div v-if="post.tags.length > 0">
          <span class="font-weight-bold">Tags: </span>
          <router-link
            :to="{ name: 'tag', params: { slug: tag.slug } }"
            class="badge badge-warning mr-2"
            v-for="tag in post.tags"
            :key="`tag-${tag.id}`"
            >{{ tag.name }}</router-link
          >
        </div>
        <div v-else>
          <span class="font-weight-bold"
            >Tags: <strong class="no text-danger">none</strong></span
          >
        </div>
        <router-link
          class="view mt-3"
          :to="{ name: 'post', params: { slug: post.slug } }"
        >
          <i class="fas fa-book-open"></i>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import VueLoadImage from 'vue-load-image';

export default {
  name: "Card",
  components: {
    VueLoadImage
  },
  props: {
    post: Object,
    categories: Array,
  },
  methods: {},
};
</script>

<style lang="scss" scoped>
.post-img {
  height: 200px;
  object-fit: cover;
  transition: transform 0.5s ease-in-out;
  &:hover {
    transform: scale(1.2);
  }
}

.view {
  transition: all 0.5s ease-in-out;
}

.no {
  cursor: not-allowed;
}
</style>