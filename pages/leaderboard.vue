<template>
  <div class="container">
    <h1>Leaderboard</h1>
    <p></p>
    <b-pagination
      v-model="currentPage"
      :total-rows="totalRows"
      :per-page="perPage"
      align="fill"
      size="sm"
      class="my-0"
    ></b-pagination>
    <b-table
      show-empty
      ref="leaderboard"
      :items="entries"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
    >
      <template v-slot:cell(actions)="row">
        <b-button
          size="sm"
          @click="info(row.item, row.index, $event.target)"
          class="mr-1"
        >
          Load board
        </b-button>
      </template>

      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">
              {{ key }}: {{ value }}
            </li>
          </ul>
        </b-card>
      </template>
    </b-table>
  </div>
</template>
<script>
export default {
  name: "Leaderboard",
  data() {
    return {
      entries: [],
      fields: [
        { key: "name", label: "Name" },
        { key: "attemptedAt", label: "Timestamp" },
        { key: "duplicatesEnabled", label: "Duplicates enabled?" },
        {
          key: "timeTaken",
          label: "Time taken",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "attempts",
          label: "Attempts",
          sortable: true,
          sortDirection: "desc"
        }
      ],
      currentPage: 1,
      perPage: 10,
      totalRows: 0
    };
  },
  mounted: function() {
    this.load();
  },
  methods: {
    load: function() {
      this.$axios
        .get("https://mastermind.thomas.gg/api/leaderboard")
        .then(res => {
          this.entries = res.data;
          this.totalRows = res.data.length;
          this.$refs.leaderboard.refresh();
          console.log("ok");
          console.log(res);
        })
        .catch(function(error) {
          console.log(error);
          alert("Something went wrong getting the leaderboard...");
        });
    }
  }
};
</script>
