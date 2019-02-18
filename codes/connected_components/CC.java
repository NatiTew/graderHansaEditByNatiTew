public class CC {
	private boolean[] marked;
	private int[] id;
	private int count;
	private Graph G;

	public CC(Graph G) {
		this.G = G;
		marked = new boolean[G.V()];
		id = new int[G.V()];
		for (int v = 0; v < G.V(); v++) {
			if (!marked[v]) {
				dfs(v);
				count++;
			}
		}
	}

	public int count() {
		return count;
	}

	public int id(int v) {
		return id[v];
	}

	public boolean connected(int v, int w) {
		return id[v] == id[w];
	}

	private void dfs(int v) {
		marked[v] = true;
		id[v] = count;
		for (int w : G.adj(v))
			if (!marked[w])
				dfs(w);
	}

}
