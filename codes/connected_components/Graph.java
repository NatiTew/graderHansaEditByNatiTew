import java.util.ArrayList;

public class Graph {
	private final int V;
	private int E;
	private ArrayList<Integer>[] adj;

	@SuppressWarnings("unchecked")
	public Graph(int V) {
		this.V = V;
		adj = (ArrayList<Integer>[]) new ArrayList[V]; // Not type-safe
		for (int v = 0; v < V; v++)
			adj[v] = new ArrayList<Integer>();
	}

	public void addEdge(int v, int w) {
		E++;
		adj[v].add(w);
		adj[w].add(v); // comment this if graph is directed
	}

	public ArrayList<Integer> adj(int v) {
		return adj[v];
	}

	public int degree(int v) {
		return adj[v].size();
	}

	int V() { return V;	}

	int E() { return E;	}
}
