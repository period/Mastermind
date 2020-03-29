<template>
  <b-container fluid>
    <b-row>
      <b-col sm="9">
        <h1>Make your guess here</h1>
        <p>Current input:</p>
        <GuessBtn
          v-for="colour in currentGuess"
          :colour="colour"
          :key="colour.name"
          :addToGuess="addToGuess"
        />
        <p>Click on 4 dots in the order of your guess, and then click submit. Use the reset button if you wish to amend your guess before submitting.</p>
        <GuessBtn
          v-for="colour in colours"
          :colour="colour.hex"
          :key="colour.name"
          :addToGuess="addToGuess"
        />
      </b-col>
      <b-col>
        <h1>Guesses</h1>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import GuessBtn from "../components/GuessBtn";
export default {
  components: {
    GuessBtn
  },
  data: function() {
    return {
      colours: [
        {name: "red", hex: "#e84118"},
        {name: "green", hex: "#4cd137"},
        {name: "blue", hex: "#00a8ff"},
        {name: "dark blue", hex: "#273c75"},
        {name: "yellow", hex: "#fbc531"},
        {name: "purple", hex: "#9c88ff"}
      ],
      currentGuess: []
    };
  },
  methods: {
    addToGuess: function(colour) {
      if (this.currentGuess.length == 4) {
        alert("Only 4 pegs per guess, please...");
        return;
      }
      this.currentGuess.push(colour);
    }
  }
};
</script>
