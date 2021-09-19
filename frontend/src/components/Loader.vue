<template>
  <div class="loader">
    <p>Loading...</p>
  </div>
</template>

<style scoped>
.loader {
  width: 100vw;
  height: 100vh;
  background: white;
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1000000;
}
</style>

<script>
export default {
  name: "Loader"
}
</script>