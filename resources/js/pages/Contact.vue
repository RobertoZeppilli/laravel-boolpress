<template>
  <form @submit.prevent="sendMessage" class="contact pt-5">
    <h1>Contact Us!</h1>
    <div v-show="success" class="alert alert-success full">
      <h6 class="font-weight-bold">Messaggio inviato con successo!</h6>
      <i class="mt-5 slide fa fa-check fa-2x"></i>
      <router-link class="back btn-lg btn-secondary" :to="{ name: 'home' }">
        <i class="fas fa-chevron-left"></i>
      </router-link>
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input
        type="text"
        class="form-control"
        :class="errors.name ? 'is-invalid' : ''"
        id="name"
        placeholder="Enter name..."
        v-model="name"
      />
      <small
        v-for="(error, index) in errors.name"
        :key="`err-name-${index}`"
        class="text-danger d-block"
      >
        {{ error }}
      </small>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input
        type="email"
        class="form-control"
        :class="errors.email ? 'is-invalid' : ''"
        id="email"
        placeholder="Enter email..."
        v-model="email"
      />
      <small
        v-for="(error, index) in errors.email"
        :key="`err-email-${index}`"
        class="text-danger d-block"
      >
        {{ error }}
      </small>
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea
        class="form-control"
        :class="errors.message ? 'is-invalid' : ''"
        id="message"
        rows="5"
        placeholder="Enter message..."
        v-model="message"
      ></textarea>
      <small
        v-for="(error, index) in errors.message"
        :key="`err-msg-${index}`"
        class="text-danger d-block"
      >
        {{ error }}
      </small>
    </div>

    <button class="btn btn-primary" type="submit" :disabled="sending">
      <i v-if="!sending" class="far fa-envelope-open"></i>
      <i v-else class="far fa-envelope"></i>
    </button>
  </form>
</template>

<script>
export default {
  name: "Contact",
  data() {
    return {
      name: "",
      email: "",
      message: "",
      errors: {},
      success: false,
      sending: false,
    };
  },
  methods: {
    sendMessage() {
      this.sending = true;

      axios
        .post("http://127.0.0.1:8000/api/leads", {
          name: this.name,
          email: this.email,
          message: this.message,
        })
        .then((res) => {
          this.sending = false;

          if (res.data.errors) {
            this.errors = res.data.errors;
            this.success = false;
          } else {
            this.errors = {};
            this.name = "";
            this.email = "";
            this.message = "";
            this.success = true;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss">
.contact {
  position: relative;
  height: calc(100vh - 100px);
  .full {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 50%;
    width: 50%;
    .back {
      position: absolute;
      bottom: 10px;
      left: 10px;
    }
    .slide {
      animation: slide-in 0.5s forwards;
      height: 50px;
      position: absolute;
      left: -100%;
      top: 50%;
      transform: translateY(-50%);
    }
    @keyframes slide-in {
      100% {
        left: 50%;
        transform: translate(-50%, -50%);
      }
    }
  }
}
</style>