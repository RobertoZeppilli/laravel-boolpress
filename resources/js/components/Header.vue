<template>
  <header class="bg-dark text-light">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <router-link class="logo-link" :to="{ name: 'home' }">
          <h1 class="logo">My<span class="text-info text-bold">Blog</span></h1>
        </router-link>

        <nav class="d-flex align-items-center">
          <ul
            class="d-flex align-items-center text-uppercase list-unstyled m-0"
          >
            <li>
              <router-link
                class="text-decoration-none text-light"
                :to="{ name: 'home' }"
                >Home</router-link
              >
            </li>
            <li class="ml-5">
              <router-link
                class="text-decoration-none text-light"
                :to="{ name: 'blog' }"
                >Blog</router-link
              >
            </li>
            <li class="ml-5">
              <router-link
                class="text-decoration-none text-light"
                :to="{ name: 'about' }"
                >About</router-link
              >
            </li>
            <li class="ml-5">
              <router-link
                class="text-decoration-none text-light"
                :to="{ name: 'contacts' }"
                >Contacts</router-link
              >
            </li>
            <li class="ml-5">
              <a
                class="text-decoration-none text-light btn btn-info"
                href="http://127.0.0.1:8000/admin"
                >Admin</a
              >
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style lang="scss" scoped>
header {
  height: 50px;
  .logo-link {
    &:hover {
      text-decoration: none;
    }
    .logo {
      cursor: pointer;
      color: #fff;
    }
  }
  li {
    a {
      display: inline-block;
      padding: 5px 10px;
      &.active,
      &:hover {
        background-color: #6cb2eb;
      }
    }
  }
}
</style>