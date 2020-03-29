<template>
  <div
    class="guessbtn"
    :style="{ 'background-color': colour }"
    @click="addToGuess(colour)"
  >
  </div>
</template>

<script>
export default {
  name: "GuessBtn",
  props: ["colour", "addToGuess"]
};
</script>

<style>
/* shamelessly stolen from https://www.w3schools.com/howto/howto_css_circles.asp because i dont do css */
.guessbtn {
  height: 50px;
  width: 50px;
  border-radius: 50%;
  display: inline-block;
  margin-left: 5%;
}
</style>
