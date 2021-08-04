<template>
  <div class="tag py-3" v-if="tag">
    <h4>
      Posts from tag:
      <strong class="badge badge-warning">{{ tag.name }}</strong>
    </h4>
    <div v-if="tag.posts.length > 0" class="d-flex flex-column">
      <router-link
        class="blob"
        v-for="post in tag.posts"
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
  name: "Tag",
  data() {
    return {
      tag: null,
    };
  },
  components: {
    Loader,
  },
  methods: {
    getTag(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/tags/${slug}`)
        .then((res) => {
          if (JSON.stringify(res.data) == "{}") {
            this.$router.push({ name: "not-found" });
          } else {
            this.tag = res.data;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.getTag(this.$route.params.slug);
  },
};
</script>

<style lang="scss">
.tag {
  height: calc(100vh - 100px);
  .blob {
    width: max-content;
    padding: 30px;
    margin-bottom: 20px;
    border-radius: 40px 53% 57% 50px;
    font-weight: bold;
    color: #343a40;
    background-color: #e6e77e;
    transition: all .5s ease-in-out;

    &:hover {
        text-decoration: none;
        transform: scale(1.2);
    }
  }
}
</style>