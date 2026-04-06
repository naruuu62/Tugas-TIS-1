<script setup>
</script>

<template>
  <div class="app-layout">
    <nav class="navbar">
      <router-link to="/">Home</router-link> |
      <router-link to="/auth/login">Login</router-link> |
      <router-link to="/auth/register">Register</router-link>
    </nav>
    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<style scoped>
.navbar {
  padding: 1rem;
  margin-bottom: 2rem;
  background-color: #242424;
  text-align: center;
}
.navbar a {
  color: #646cff;
  text-decoration: none;
  font-weight: bold;
}
.navbar a:hover {
  color: #535bf2;
}
.app-layout {
  width: 100%;
}
</style>
