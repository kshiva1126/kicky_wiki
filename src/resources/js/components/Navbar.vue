<template>
  <nav class="nav">
    <a class="nav__brand" href="/">Kicky-WIKI</a>
    <div class="nav__menu">
      <div class="nav__item">
        <router-link :to="'/post'">投稿する</router-link>
      </div>
    </div>
  </nav>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.nav {
  align-items: center;
  background: #ffffff;
  box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.2);
  display: flex;
  justify-content: space-between;
  position: relative;
  padding: 0.5rem 1rem;
  > .nav__brand {
    font-size: 3rem;
  }
  > .nav__menu {
  }
}
</style>
