<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" class="text-center">
          <b-alert variant="success" v-if="hasWon == true" show>Successfully cracked the code in {{ submittedGuesses.length }} moves.</b-alert>
      </b-col>
    </b-row>
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
        <p>
          Click on 4 dots in the order of your guess, and then click submit. Use
          the reset button if you wish to amend your guess before submitting.
        </p>
        <GuessBtn
          v-for="colour in colours"
          :colour="colour.hex"
          :key="colour.name"
          :addToGuess="addToGuess"
        />
        <hr />
        <div class="text-center">
          <b-button
            variant="primary"
            v-if="currentGuess.length == 4"
            @click="submitGuess"
            >Submit</b-button
          >
          <b-button variant="danger" @click="currentGuess = []">Reset</b-button>
        </div>
      </b-col>
      <b-col>
        <h1>Guesses</h1>
        <SubmittedGuess
          v-for="guess in submittedGuesses"
          :guess="guess"
          :addToGuess="addToGuess"
          :correctCode="correctCode"
          :key="
            Math.random()
              .toString(36)
              .slice(2)
              .replace(/[0-9]/g, '')
          "
          :handleWin="handleWin"
        />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import GuessBtn from "../components/GuessBtn";
import SubmittedGuess from "../components/SubmittedGuess";
export default {
  name: "Play",
  components: {
    GuessBtn,
    SubmittedGuess
  },
  data: function() {
    return {
      colours: [
        { name: "red", hex: "#e84118" },
        { name: "green", hex: "#4cd137" },
        { name: "blue", hex: "#00a8ff" },
        { name: "dark blue", hex: "#273c75" },
        { name: "yellow", hex: "#fbc531" },
        { name: "purple", hex: "#9c88ff" }
      ],
      currentGuess: [],
      submittedGuesses: [],
      correctCode: [],
      allowDuplicatesInCode: false,
      hasWon: true
    };
  },
  mounted: function() {
    if (localStorage.getItem("allow-duplicates") == null)
      localStorage.setItem("allow-duplicates", false);
    this.allowDuplicatesInCode = localStorage.getItem("allow-duplicates");

    if (this.allowDuplicatesInCode == true)
      for (var i = 0; i < 4; i++)
        this.correctCode.push(
          this.colours[Math.floor(Math.random() * this.colours.length)].hex
        );
    else
      while (this.correctCode.length != 4) {
        let pickedColour = this.colours[
          Math.floor(Math.random() * this.colours.length)
        ].hex;
        if (this.correctCode.includes(pickedColour) == false)
          this.correctCode.push(pickedColour);
      }
  },
  methods: {
    handleWin: function() {
      this.hasWon = true;
    },
    submitGuess: function() {
      if (this.currentGuess.length != 4) {
        alert("Only 4 pegs per guess, please...");
        return;
      }
      this.submittedGuesses.unshift(this.currentGuess);
      this.currentGuess = [];
    },
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
