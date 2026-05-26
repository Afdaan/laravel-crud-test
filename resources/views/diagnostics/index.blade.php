@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
        <div>
            <h2 style="font-size: 2rem; font-weight: 700; background: linear-gradient(to right, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Webhook & PaaS Diagnostics
            </h2>
            <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Verify git auto-deployments, environment setup, and system integration.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn" style="background: rgba(255,255,255,0.05); color: white; border: 1px solid rgba(255,255,255,0.1);">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Diagnostic Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        
        <!-- Git & Webhook Integration Card -->
        <div class="card" style="border: 1px solid rgba(99, 102, 241, 0.25); position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #6366f1, #a855f7);"></div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #818cf8;">⚡ Git & Webhook Status</h3>
                <span class="pulse-badge">Integrated</span>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div>
                    <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">CURRENT BRANCH</span>
                    <span style="font-family: monospace; background: rgba(99, 102, 241, 0.15); color: #a5b4fc; padding: 0.2rem 0.6rem; border-radius: 0.375rem; font-weight: 600; font-size: 0.85rem; border: 1px solid rgba(99, 102, 241, 0.2);">
                        🌿 {{ $gitBranch }}
                    </span>
                </div>

                <div>
                    <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">ACTIVE DEPLOYMENT COMMIT</span>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                        <span class="commit-hash-badge">#{{ $commitHashShort }}</span>
                        <span style="color: var(--text-muted); font-size: 0.8rem;">(Full: {{ substr($commitHash, 0, 12) }}...)</span>
                    </div>
                    <p style="font-size: 1rem; font-weight: 600; color: var(--text); margin-top: 0.35rem;">
                        "{{ $commitMessage }}"
                    </p>
                </div>

                <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem; display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.85rem;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--text-muted);">Committed By:</span>
                        <strong style="color: var(--text);">{{ $commitAuthor }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--text-muted);">Deployment Date:</span>
                        <span style="color: var(--text);">{{ $commitDate }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- System & Database Integration Card -->
        <div class="card" style="border: 1px solid rgba(16, 185, 129, 0.25); position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #10b981, #34d399);"></div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #34d399;">🖥️ Server & Database</h3>
                <span class="status-badge-active">Online</span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div>
                    <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">DATABASE CONNECTION</span>
                    @if($dbStatus === 'Connected')
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-weight: 600; font-size: 0.95rem;">
                            <span class="dot-green"></span> Connected Successfully
                        </div>
                    @else
                        <div style="color: var(--danger); font-weight: 600; font-size: 0.95rem;">
                            ⚠️ Disconnected
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem; font-weight: normal;">{{ $dbError }}</p>
                        </div>
                    @endif
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.4rem;">
                        <span>CONTAINER DISK SPACE</span>
                        <span>{{ $diskFreeHuman }} free of {{ $diskTotalHuman }}</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar-fill" style="width: {{ $diskPercent }}%;"></div>
                    </div>
                    <span style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.35rem; display: block;">Using {{ $diskPercent }}% of allocated storage</span>
                </div>

                <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem; display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.85rem;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--text-muted);">PHP Version:</span>
                        <strong style="color: var(--text);">v{{ $phpVersion }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--text-muted);">Laravel Version:</span>
                        <strong style="color: var(--text);">v{{ $laravelVersion }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deployed Environment Configuration -->
        <div class="card" style="border: 1px solid rgba(245, 158, 11, 0.25); position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #fbbf24;">⚙️ Environment Configuration</h3>
                <span style="font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.5rem; background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 0.25rem; color: #fef08a;">
                    Read-Only
                </span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.75rem; font-family: monospace; font-size: 0.85rem; background: rgba(0, 0, 0, 0.25); padding: 1rem; border-radius: 0.75rem; border: 1px solid var(--border);">
                @foreach($envInfo as $key => $value)
                    <div style="display: flex; justify-content: space-between; gap: 1rem;">
                        <span style="color: #94a3b8;">{{ $key }}:</span>
                        <span style="color: #fbbf24; font-weight: 600; text-align: right; word-break: break-all;">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
            
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 1rem; line-height: 1.4;">
                💡 <strong>PaaS Env Vars:</strong> These variables represent the loaded environment properties of your active PaaS container.
            </p>
        </div>
    </div>

    <!-- Webhook Integration Live Tester (Simulation & Logging Console) -->
    <div class="card" style="margin-bottom: 2.5rem; border-color: rgba(99, 102, 241, 0.2);">
        <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
            🔮 Live Webhook Delivery & Auto-Deployment Console
        </h3>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
            Test how your PaaS handles webhooks. Click the button below to simulate a Webhook Git Push payload and inspect the automated build step outputs!
        </p>

        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
            <button onclick="simulateWebhook()" id="simBtn" class="btn btn-primary" style="gap: 0.5rem;">
                ⚡ Simulate Webhook Push Event
            </button>
            <button onclick="clearConsole()" class="btn" style="background: transparent; border: 1px solid var(--border); color: var(--text-muted);">
                Clear Console
            </button>
        </div>

        <!-- Terminal Output Simulator -->
        <div class="terminal-window">
            <div class="terminal-titlebar">
                <span class="terminal-dot dot-red"></span>
                <span class="terminal-dot dot-yellow"></span>
                <span class="terminal-dot dot-green"></span>
                <span class="terminal-title">webhook-deploy-worker.sh</span>
            </div>
            <div class="terminal-body" id="termBody">
                <div class="terminal-line"><span style="color: #6366f1;">[info]</span> Ready to receive GitHub Webhook callbacks. Standing by...</div>
                <div class="terminal-line"><span style="color: #6366f1;">[info]</span> Active webhook integration endpoint: <span style="color: #34d399;">https://your-paas.domain/webhooks/git/app</span></div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Pulse badge animation */
    .pulse-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 9999px;
        color: #a5b4fc;
        animation: pulse-border-blue 2s infinite;
    }

    @keyframes pulse-border-blue {
        0% { border-color: rgba(99, 102, 241, 0.3); box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.3); }
        70% { border-color: rgba(99, 102, 241, 0.8); box-shadow: 0 0 0 6px rgba(99, 102, 241, 0); }
        100% { border-color: rgba(99, 102, 241, 0.3); box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
    }

    .status-badge-active {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 9999px;
        color: #34d399;
    }

    .commit-hash-badge {
        font-family: monospace;
        background: rgba(255, 255, 255, 0.08);
        padding: 0.15rem 0.45rem;
        border-radius: 0.375rem;
        color: #e2e8f0;
        font-weight: 600;
        font-size: 0.9rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .dot-green {
        width: 8px;
        height: 8px;
        background-color: var(--success);
        border-radius: 50%;
        display: inline-block;
    }

    .progress-bar-container {
        width: 100%;
        height: 8px;
        background: rgba(255,255,255,0.05);
        border-radius: 9999px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(to right, #10b981, #34d399);
        border-radius: 9999px;
    }

    /* Terminal Styles */
    .terminal-window {
        background: #090d16;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 0.75rem;
        overflow: hidden;
        font-family: 'Courier New', Courier, monospace;
        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
    }

    .terminal-titlebar {
        background: #111827;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .terminal-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .dot-red { background-color: #ef4444; }
    .dot-yellow { background-color: #f59e0b; }
    .dot-green { background-color: #10b981; }

    .terminal-title {
        color: var(--text-muted);
        font-size: 0.8rem;
        margin-left: 0.5rem;
        font-weight: 600;
    }

    .terminal-body {
        padding: 1.25rem;
        height: 250px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        font-size: 0.85rem;
        line-height: 1.5;
        color: #cbd5e1;
    }

    .terminal-line {
        white-space: pre-wrap;
    }
</style>

<script>
    function simulateWebhook() {
        const term = document.getElementById('termBody');
        const btn = document.getElementById('simBtn');
        btn.disabled = true;
        btn.innerText = '🔄 Deploying webhook...';

        const lines = [
            '<span style="color: #fbbf24;">[webhook]</span> GitHub webhook received! Event: push. Branch: refs/heads/{{ $gitBranch }}',
            '<span style="color: #6366f1;">[paas]</span> Signature validation passed. Triggering auto-redeploy script...',
            '<span style="color: #6366f1;">[paas]</span> Initializing build environment. Docker image cache matched.',
            '<span style="color: #6366f1;">[paas]</span> Fetching latest delta changes from repository remote...',
            '<span style="color: #34d399;">[git]</span> Pull completed. Commit hash: <span style="color: #818cf8;">{{ $commitHashShort }}</span> - "{{ $commitMessage }}"',
            '<span style="color: #6366f1;">[paas]</span> Resolving Composer dependencies (cached)...',
            '<span style="color: #6366f1;">[paas]</span> Optimizing configurations, classes and routes...',
            '<span style="color: #34d399;">[artisan]</span> config:cache - Configuration cached successfully!',
            '<span style="color: #34d399;">[artisan]</span> route:cache - Routes cached successfully!',
            '<span style="color: #6366f1;">[paas]</span> Performing zero-downtime hot swap reload...',
            '<span style="color: #10b981;">[success]</span> Container fully redeployed and active. Took 1.84 seconds! 🎉'
        ];

        let index = 0;
        
        function printNextLine() {
            if (index < lines.length) {
                const lineDiv = document.createElement('div');
                lineDiv.className = 'terminal-line';
                lineDiv.innerHTML = lines[index];
                term.appendChild(lineDiv);
                term.scrollTop = term.scrollHeight;
                index++;
                setTimeout(printNextLine, 450);
            } else {
                btn.disabled = false;
                btn.innerText = '⚡ Simulate Webhook Push Event';
            }
        }

        printNextLine();
    }

    function clearConsole() {
        const term = document.getElementById('termBody');
        term.innerHTML = '<div class="terminal-line"><span style="color: #6366f1;">[info]</span> Terminal cleared. Ready.</div>';
    }
</script>
@endsection
