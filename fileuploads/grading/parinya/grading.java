import java.util.Scanner;
public class grading {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Scanner kb = new Scanner(System.in);
		int score = kb.nextInt();
		
		if(score<50){
			System.out.println("F");
		}else if(score<55){
			System.out.println("D");
		}else if(score<60){
			System.out.println("D+");
		}else if(score<65){
			System.out.println("C");
		}else if(score<70){
			System.out.println("C+");
		}else if(score<75){
			System.out.println("B");
		}else if(score<80){
			System.out.println("B+");
		}else{
			System.out.println("A");
		}
	}

}
