<script setup>
 const props = defineProps({
    value: String,
    name: String,
    diff: Boolean,
    value2 : String,
  
})

function highlightDiff(str1, str2) {
   let word1 = str1.split(" ");
   let word2 = str2.split(" ");

    return {
      str1: word1.map((word) => {
        return word2.includes(word) ? word : `<span class="text-blue-500">${word}</span>`;
      }).join(" "),
      str2: word2.map((word) => {
        return word1.includes(word) ? word : `<span class="text-green-500">${word}</span>`;
      }).join(" ")
    }
   }


</script>

<template>
<span v-if="value" class="bold-entity-name">{{name}} : </span>
    <span v-if="!diff">
        <span v-if="value" class="entity-value"><br v-if="value">{{ value}}</span><br v-if="value">
    </span>
    <span v-if="diff"><br v-if="value && value2">
        <span v-if="value && value2" v-html="highlightDiff(value2, value).str2" class="entity-value"></span>
        <span v-else class="entity-value"><br v-if="value">{{ value }}</span><br v-if="value">
    </span>
</template>