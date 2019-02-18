void q_sort(int numbers[], int left, int right)
 {
   int l_hold = left;
   int r_hold = right;
   int pivot = numbers[left];
   int t;
   while (left < right)
   {
     while ((numbers[right] >= pivot) && (left < right))
       right--;
     if (left != right)
     {
       t = numbers[left]; numbers[left] = numbers[right]; numbers[right] = t;
       left++;
     }
     while ((numbers[left] <= pivot) && (left < right))
       left++;
     if (left != right)
     {
       t = numbers[right]; numbers[right] = numbers[left]; numbers[left] = t;
       right--;
     }
   }
   numbers[left] = pivot;
   pivot = left;
   left = l_hold;
   right = r_hold;
   if (left < pivot)
     q_sort(numbers, left, pivot-1);
   if (right > pivot)
     q_sort(numbers, pivot+1, right);
 }
void quickSort(int numbers[], int array_size)
{
   q_sort(numbers, 0, array_size - 1);
}