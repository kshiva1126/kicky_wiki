<template>
  <div>
    <header>
      <Navbar/>
    </header>
    <main>
      <RouterView/>
    </main>
  </div>
</template>

<script>
import Navbar from "./components/Navbar";

export default {
  components: {
    Navbar
  }
};
</script>
