<script setup>
const { hp1, hp2, entity, value1, value2 } = defineProps({
  hp1: Object,
  hp2: Object,
  entity: String,
  value1: String,
  value2: String,
  diff: Boolean,
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
  <tr class="border-b-2 border-gray-400 align-top text-xs md:text-base">
    <td
      v-if="hp1"
      class="right-border w-1/2 break-words whitespace-normal p-2"
    >
      <span v-if="hp1" class="bold-entity-name">{{ entity }} :</span><br>
      <span v-if="!diff" class="entity-value">{{ value1 }}</span>
      <span v-if="diff" v-html="highlightDiff(value1, value2).str1" class="entity-value"></span>
    </td>

    <td
      v-if="hp2"
      class="w-1/2 break-words whitespace-normal p-2"
    >
      <span  class="bold-entity-name">{{ entity }} :</span><br>
      <span v-if="!diff" class="entity-value">{{ value2 }}</span>
      <span v-if="diff" v-html="highlightDiff(value1, value2).str2" class="entity-value"></span>
    </td>
  </tr>
</template>
