import java.util.Arrays;


public class Sorts {
	
	public static void selectionSort(int[] a) {
		for (int i = a.length-1; i >= 1; i--) {
			int index = i; // i is the last item position and 
			                     // index is the largest element position
			// loop to get the largest element
			for (int j = 0; j < i; j++) {
				if (a[j] > a[index]) 
					index = j; // j is the current largest item
			}
			// Swap the largest item a[index] with the last item a[i]
			int temp = a[index];
			a[index] = a[i]; 
			a[i] = temp;
		}
	}
	
	public static void bubbleSort(int[] a)  {
		for (int i = 1; i < a.length; i++) {
			for (int j = 0; j < a.length - i; j++) {
				if (a[j] > a[j+1]) { // the larger item bubbles down (swap)
					int temp = a[j]; 
					a[j] = a[j+1]; 
					a[j+1] = temp; 
				}
	 		}
		}
	}

	public static void insertionSort(int[] a) {
		for (int i=1;i<a.length;i++) { //Q: Why i starts from 1?
			// a[i] is the next data to insert
			int next = a[i];
			// Scan backwards to find a place. Q: Why not scan forwards?
			int j;  // Q: Why is j declared here? 
			// Q: What if a[j] <= next?
			for (j=i-1; j>=0 && a[j]>next; j--)
				a[j+1] = a[j];

			// Now insert the value next after index j at the end of loop
			a[j+1] = next;  
		}
	}
	
	/****************** Merge Sort ***********************/

	public static void  mergeSort(int[] a, int i, int j) {
		// to sort data from a[i] to a[j], where i<j
		if (i < j) {  // Q: What if i >= j?
			int mid = (i+j)/2;     // divide
			mergeSort(a, i, mid);  // recursion
			mergeSort(a, mid+1, j);	
			merge(a,i,mid,j); //conquer: merge a[i..mid] and
			                  //a[mid+1..j] back into a[i..j]
		}
	}
	public static void merge(int[] a, int i, int mid, int j) {
		// Merges the 2 sorted sub-arrays a[i..mid] and
		// a[mid+1..j] into one sorted sub-array a[i..j]

		int[] temp = new int[j-i+1];  // temp storage
		int left = i, right = mid+1, it = 0; 
		// it = next index to store merged item in temp[] 
		// Q: What are left and right?

		while (left<=mid && right<=j) { // output the smaller
			if (a[left] <= a[right])
				temp[it++] = a[left++];
			else
				temp[it++] = a[right++]; 
		}
		// Copy the remaining elements into temp. Q: Why?
		while (left<=mid) temp[it++] = a[left++];
		while (right<=j)  temp[it++] = a[right++];
		// Q: Will both the above while statements be executed?

		// Copy the result in temp back into 
		// the original array a
		for (int k = 0; k < temp.length; k++) 
			a[i+k] = temp[k];
	}
	/**********************************************************/
	/**********************************************************/
	
	
	/****************** Quick Sort ***********************/
	public static void quickSort(int[] a, int i, int j) {
		if (i < j) {  // Q: What if i >= j?
			int pivotIdx = partition(a, i, j);
			quickSort(a, i, pivotIdx-1);
			quickSort(a, pivotIdx+1, j);	
			// No conquer part! Why?	
		}
	}
	public static int partition(int[] a, int i, int j) {
		// partition data items in a[i..j]
		int p = a[i]; // p is the pivot, the ith item
		int m = i;	    // Initially S1 and S2 are empty
		for (int k=i+1; k<=j; k++) { //process unknown region
			if (a[k] < p) {  // case 2: put a[k] to S1
				m++;
				int temp = a[k]; 
				a[k] = a[m]; 
				a[m] = temp; 
			} else {	 // case 1: put a[k] to S2. Do nothing!
			}  // else part should be removed since it is empty 
		}
		// put the pivot at the right place
		int temp = a[i]; 
		a[i] = a[m]; 
		a[m] = temp; 
		return m;    // m is the pivot’s final position
	}
	/**********************************************************/
	/**********************************************************/
	
	public static void main(String [] s) {
		int [] arr = {1, 20, 15, 10, 9, 8, 7, 6, 12};
		
		// selectionSort(arr);
		// bubbleSort(arr);
		// insertionSort(arr);
		
		// mergeSort(arr, 0, arr.length-1);
		quickSort(arr, 0, arr.length-1);
		
		System.out.println(Arrays.toString(arr));
	}

}
