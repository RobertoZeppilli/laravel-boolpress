<template>
  <section class="post py-3" v-if="!loading">
    <div>
      <h2>{{ post.title }}</h2>
      <div class="info">
        <div
          v-if="post.category"
          class="mb-2"
          :class="post.tags.length > 0 ? 'mr-5' : ''"
        >
          <router-link
            :to="{ name: 'category', params: { slug: post.category.slug } }"
            class="badge badge-info text-light"
            >{{ post.category.name }}</router-link
          >
        </div>
        <div class="mb-2" v-else>
          <h6 class="text-danger">No Category</h6>
        </div>
        <div class="h6" v-if="post.tags.length > 0">
          <router-link
            v-for="tag in post.tags"
            :key="tag.id"
            :to="{ name: 'tag', params: { slug: tag.slug } }"
            class="badge badge-pill badge-warning mr-2"
            >{{ tag.name }}</router-link
          >
        </div>
        <div v-else>
          <h6 class="text-danger">No Tags</h6>
        </div>
      </div>
    </div>
    <!-- <img class="w-100 my-3" :src="post.cover" :alt="post.title" /> -->
    <vue-load-image>
      <img class="w-100 my-3" slot="image" :src="post.cover" />
      <img
        class="w-100"
        slot="preloader"
        src="https://i.stack.imgur.com/ndqUb.gif"
      />
      <div class="text-danger" slot="error">No cover found.</div>
    </vue-load-image>
    <p>{{ post.body }}</p>
    <div>
      <router-link class="btn btn-secondary" :to="{ name: 'blog' }">
        <i class="fas fa-arrow-left"></i>
      </router-link>
    </div>
  </section>
  <Loader v-else />
</template>

<script>
import Loader from "../components/Loader";
import NotFound from "../pages/NotFound";
import VueLoadImage from 'vue-load-image';

export default {
  name: "Post",
  data() {
    return {
      post: null,
      loading: true,
    };
  },
  components: {
    Loader,
    NotFound,
    VueLoadImage
  },
  methods: {
    getPost(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/posts/${slug}`)
        .then((res) => {
          if (JSON.stringify(res.data) == "{}") {
            this.$router.push({ name: "not-found" });
          } else {
            this.post = res.data;
            this.loading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.getPost(this.$route.params.slug);
  },
};
</script>

<style>
h6 {
  cursor: not-allowed;
}
</style>