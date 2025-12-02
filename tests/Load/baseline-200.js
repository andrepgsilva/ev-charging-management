import http from 'k6/http';

const payload = JSON.stringify(JSON.parse(open('./payload.json')));

export const options = {
    scenarios: {
        baseline: {
            executor: 'constant-arrival-rate',
            rate: 200,
            timeUnit: '1s',
            duration: '5m',
            preAllocatedVUs: 200,
            maxVUs: 500,
        },
    },
};

export default function() {
    http.post('http://localhost:8080/api/charger-events/session-started', payload, {
        headers: { 'Content-Type': 'application/json' }
    });
}
