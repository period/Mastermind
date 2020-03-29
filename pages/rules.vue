<template>
  <div class="container">
    <h1>The goal</h1>
    <p>
      Guess the code in the least amount of guesses possible. The code is made
      up of 4 coloured 'pegs'.
    </p>
    <h1>What do the pegs mean?</h1>
    <ul>
      <li>
        A white peg indicates that the codebreaker has the right colour, but
        that it is in the wrong position
      </li>
      <li>
        A red peg indicates that the codebreaker has the right colour and that
        the colour is in the correct position
      </li>
      <li>No peg means that the colour is not in the secret code</li>
      <li>The pegs are in no particular order</li>
    </ul>
    <h3>That's about it. Now play.</h3>
  </div>
</template>

<script>
export default { name: "Rules" };
</script>
