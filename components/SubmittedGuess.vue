<template>
  <div>
    <GuessBtn
      v-for="colour in guess"
      :colour="colour"
      :key="colour.name"
      :addToGuess="addToGuess"
    />
    <GuessResultPeg
      v-for="colour in resultPegs"
      :colour="colour"
      :key="
        Math.random()
          .toString(36)
          .slice(2)
          .replace(/[0-9]/g, '')
      "
    />
  </div>
</template>

<script>
import GuessBtn from "../components/GuessBtn";
import GuessResultPeg from "../components/GuessResultPeg";
export default {
  name: "SubmittedGuess",
  components: { GuessBtn, GuessResultPeg },
  props: ["guess", "addToGuess", "correctCode"],
  data: function() {
    return { resultPegs: [] };
  },
  mounted: function() {
    //console.log(this.correctCode.join(",") + " vs " + this.guess.join(","));
    let correctIndexes = [];
    for (var i = 0; i < this.guess.length; i++) {
      if (this.guess[i] == this.correctCode[i]) {
        this.resultPegs.push("#e74c3c"); // red
        correctIndexes.push(i);
      }
    }
    for (var i = 0; i < this.guess.length; i++) {
      if (
        correctIndexes.includes(i) == false &&
        this.correctCode.includes(this.guess[i])
      ) {
        this.resultPegs.push("#bdc3c7"); // white
      }
    }
    console.log(this.resultPegs);
  }
};
</script>
