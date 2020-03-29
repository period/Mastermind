<template>
  <div
    class="guessresult"
    :style="{ 'background-color': colour }"
  >
  </div>
</template>

<script>
export default {
  name: "GuessResultPeg",
  props: ["colour"]
};
</script>

<style>
/* shamelessly stolen from https://www.w3schools.com/howto/howto_css_circles.asp because i dont do css */
.guessresult {
  height: 25px;
  width: 25px;
  border-radius: 50%;
  display: inline-block;
  margin-left: 2.55%;
}
</style>
