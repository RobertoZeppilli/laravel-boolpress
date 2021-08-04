<template>
  <div class="category py-3" v-if="category">
    <h4>
      Posts from category:
      <strong class="badge badge-info text-light">{{ category.name }}</strong>
    </h4>
    <div v-if="category.posts.length > 0" class="d-flex flex-column">
      <router-link
        class="blob"
        v-for="post in category.posts"
        :key="`post-${post.id}`"
        :to="{ name: 'post', params: { slug: post.slug } }"
      >
        {{ post.title }}
      </router-link>
    </div>
    <h4 v-else>None</h4>
    <div class="mt-3">
      <router-link class="btn btn-secondary" :to="{ name: 'blog' }">
        <i class="fas fa-arrow-left"></i>
      </router-link>
    </div>
  </div>
  <Loader v-else />
</template>

<script>
import Loader from "../components/Loader";

export default {
  name: "Category",
  data() {
    return {
      category: null,
    };
  },
  components: {
    Loader,
  },
  methods: {
    getCategory(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/categories/${slug}`)
        .then((res) => {
          if (JSON.stringify(res.data) == "{}") {
            this.$router.push({ name: "not-found" });
          } else {
            this.category = res.data;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.getCategory(this.$route.params.slug);
  },
};
</script>

<style lang="scss">
.category {
  height: calc(100vh - 100px);
  .blob {
    width: max-content;
    padding: 30px;
    margin-bottom: 20px;
    border-radius: 40px 53% 57% 50px;
    font-weight: bold;
    color: #343a40;
    background-color: #d0e2ff;
    transition: all 0.5s ease-in-out;

    &:hover {
      text-decoration: none;
      transform: scale(1.2);
    }
  }
}
</style>