<template>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand href="#">Mastermind</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
          <b-nav-item to="/rules">Guide/Rules</b-nav-item>
          <b-nav-item to="/leaderboard">Leaderboard</b-nav-item>
          <b-nav-item to="/settings">Settings</b-nav-item>
      </b-navbar-nav>

      <b-navbar-nav class="ml-auto">
        <b-button to="/play">Play a game</b-button>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: "Navbar"
};
</script>
