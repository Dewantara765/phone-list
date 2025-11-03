<script setup>
const { hp1, hp2, entity, value1, value2 } = defineProps({
  hp1: Object,
  hp2: Object,
  entity: String,
  value1: String,
  value2: String,
})
</script>

<template>
  <tr class="border-b-2 border-gray-400 align-top text-xs md:text-base">
    <td
      v-if="hp1"
      class="right-border w-1/2 break-words whitespace-normal p-2"
    >
      <span class="bold-phone-name">{{ entity }} :</span><br>
      {{ value1 }}
    </td>

    <td
      v-if="hp2"
      class="w-1/2 break-words whitespace-normal p-2"
    >
      <span class="bold-phone-name">{{ entity }} :</span><br>
      {{ value2 }}
    </td>
  </tr>
</template>
