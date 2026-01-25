import http from 'k6/http';

const payload = JSON.stringify(JSON.parse(open('./payload.json')));

export const options = {
    scenarios: {
        baseline: {
            executor: 'constant-arrival-rate',
            rate: 80,
            timeUnit: '1s',
            duration: '5m',
            preAllocatedVUs: 400,
            maxVUs: 500,
        },
    },
};

export default function() {
    http.post('http://localhost:8080/api/charger-events/session-started', payload, {
        headers: { 'Content-Type': 'application/json' }
    });
}
