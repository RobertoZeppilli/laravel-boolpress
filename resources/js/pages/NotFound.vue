<template>
  <div class="not-found d-flex flex-column align-items-center justify-content-center">
      <h3 class="font-weight-bold">Error 404</h3>
      <img class="my-5" src="https://image.flaticon.com/icons/png/128/2748/2748791.png" alt="">
      <p>Page not found.</p>
      <router-link class="btn btn-secondary" :to="{ name: 'blog' }">
        <i class="fas fa-arrow-left"></i>
      </router-link>
  </div>
</template>

<script>
export default {
    name: 'NotFound'
}
</script>

<style lang="scss" scoped>
.not-found {
    height: calc(100vh - 100px);

    p {
        font-size: 18px;
    }
}
</style>